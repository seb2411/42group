<?php

namespace FortyTwoGroup\MessengeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FortyTwoGroup\MessengeBundle\Document\Message;
use FortyTwoGroup\MessengeBundle\Form\MessageSmsType;
use FortyTwoGroup\MessengeBundle\Form\MessageWhatsappType;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $message = new Message();

        $formSms = $this->createForm(new MessageSmsType(), $message);
        $formWhatsapp = $this->createForm(new MessageWhatsappType(), $message);

        $formSms->handleRequest($request);
        $formWhatsapp->handleRequest($request);

        if ($isValid = $formSms->isValid()) {
            $data = $formSms->getData();
            $file = $request->files->get('messageSms')['attachment'];
        } elseif ($isValid = $formWhatsapp->isValid()) {
            $data = $formWhatsapp->getData();
            $file = $request->files->get('messageWhatsapp')['attachment'];
        }
        if (isset($file)) {
            $data->setNumbers(file_get_contents($file->getPathname()));
        }


        if (isset($data)) {
            $this->sendMessage($data);
        }

        $messages = $this->getMessageList($request);

        return $this->render('FortyTwoGroupMessengeBundle:Default:index.html.twig', array(
            'formSms' => $formSms->createView(),
            'formWhatsapp' => $formWhatsapp->createView(),
            'messages' => $messages,
            'isValid' => $isValid
        ));
    }

    public function messageAction($id)
    {
        $message = $this->get('doctrine_mongodb')
            ->getRepository('FortyTwoGroupMessengeBundle:Message')
            ->find($id);

        return $this->render('FortyTwoGroupMessengeBundle:Default:message.html.twig', array(
            'message' => $message
        ));
    }

    private function sendMessage($data)
    {
        $sentAt = new \datetime();

        $numbers = trim($data->getNumbers());
        $numbersAr = explode("\n", $numbers);
        $numbersAr = array_filter($numbersAr, 'trim'); // remove any extra \r characters left behind

        foreach ($numbersAr as $number) {
            $message = new Message();
            $message->setType($data->getType());
            $message->setExclusive($data->getExclusive());
            $message->setNumbers($number);
            $message->setSender($data->getSender());
            $message->setMessage($data->getMessage());
            $message->setMessage($data->getMessage());
            $message->setStatus(rand(1, 4));
            $message->setSentAt($sentAt->format('Y-m-d'));

            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($message);
            $dm->flush();
        }
    }

    private function getMessageList(Request $request)
    {
        // Build filters
        $filters = array();
        $status = (int)$request->query->get('status');
        if ($status) {
            $filters['status'] = $status;
        }

        if ($request->query->get('date') != '') {
            $filterDate = new \datetime($request->query->get('date'));
            $filters['sentAt'] = (string)$filterDate->format('Y-m-d');
        }
        // Get message list
        $messages = $this->get('doctrine_mongodb')
            ->getRepository('FortyTwoGroupMessengeBundle:Message')
            ->findBy(
                $filters,
                array('sentAt' => 'DESC')
            );

        return $messages;
    }
}
