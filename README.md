42group - Interview Assignement
===============================

## Install:

### Using docker

1. Install [Docker](https://docs.docker.com/installation/) and [Docker Compose](https://docs.docker.com/compose/install/) on your machine (easier on Linux OS).
2. unzip the project on your machine
3. CD into the project directory
4. launch docker-compose : ``docker-compose up``

## Brief

As part of the selection process, the candidate is required to design a user interface for a fictitious product called FortyTwo Messenger, a tool aimed at companies and organisations that need to send mobile messages to their clients or members one at-a-time or in bulk.
The candidate is expected to prepare a proposal for the tool’s UI in an appropriate format and then presenting the concept design to the interviewers in a meeting.

### Product description

FortyTwo Messenger allows users to send a text message to one or more destination mobile numbers. The messenger is capable of sending messages via both SMS and Whatsapp, if the recipient has a Whatsapp account. Users of FortyTwo Messenger will interact with the service via a web-based application.

For the purpose of this exercise, we shall assume the web application includes just two main “screens” or pages:

1. A screen to send a message, plus an additional page informing the user that the message has been successfully submitted for delivery; and
2. A screen or page to view one’s own message history.

In the interest of simplicity, we shall assume that anyone visiting the page can use the service without logging in. There is no need to take care of user authentication, payment, link-aways to other pages or websites or any other details whatsoever.

#### Sending a message

The main screen is for sending a message and will request the following information from the user
1. Delivery method: - The method by which to send the message. Can be one of 4 options:
  1. “SMS only”; (if SMS not possible, do not deliver);
  2. “Whatsapp only” (if Whatsapp not possible, do not deliver);
  3. “Whatsapp preferred” (if undeliverable, try SMS);
  4. “SMS preferred” (if undeliverable, try Whatsapp);

  Note that delivery via Whatsapp is more profitable to FortyTwo and we would therefore like to subtly push this method of delivery as much as possible.

2. Destination mobile numbers: A field to enter a list of 1 or more destination mobile numbers where the message should be sent, one on each line.
Alternatively, user can upload a text file (.txt or .csv) with a list of such numbers rather than typing it.

3. Sender ID from SMS - The mobile number or text label to send as message sender when delivering message via SMS, e.g. “35699123456” or “Cstmr Care”.
The maximum length allowed is 10 characters, and can only contain alphanumeric characters. This field is unused when user selects “Whatsapp only” as delivery method.

4. SMS message content: The message to send if delivered via SMS;
SMS messages are limited to 160 characters. This field is unused when delivery is by Whatsapp only.

5. Sender ID if sent via Whatsapp - The mobile number or text label to send as message sender when delivering message via Whatsapp, e.g. “35699123456” or “Customer Care”.
In this case, the maximum length can be 20 characters, but should also be restricted to alphanumeric characters. This fields is unused when delivery is by SMS only.

6. WhatsApp message content: The text message to send if delivered via Whatsapp.
In this case, the maximum length can be 256 characters. This field is unused when delivery is via Whatsapp only.

7. A button to submit the request to FortyTwo servers.

For the purpose of this exercise, the submit button will simply display a new page informing the user that his message has been submitted, allowing the user to press a button and return to the main screen to send another message if desired.

#### Viewing message history

The message history screen will display a list of messages previously sent by the user. For each record, the following fields are displayed:
* Date sent
* Sender ID
* Destination number
* Delivery status - Pending, Sent, Delivered, Failed, All
* A “View content” button that when pressed will display message content (text) as a popup

Note that this list may contain millions of records.

The user will be able to select a single date for which to display sent messages, and may also filter messages by delivery status. For example, choosing 01/06/2015 as the date and “Failed” status will display all messages submitted on 01/06 that failed to be delivered.

Users should, at a glance, be able to pinpoint messages that have been successfully delivered, irrespective of which filter is selected.

#### Requirements

You are required to provide a simple user interface that implements the front-end of the above requirements, including validation, UI behaviours and pop-ups if necessary. You may use any web development technologies of your choice as you deem appropriate, including HTML5, CSS3, Javascript frameworks as deemed necessary, PHP, MVC...  You may assume any dummy data for the message history.

You are then being asked to demo your artefact to us in a second interview. You are also expected to explain the choice of technologies you used, the user flows of the application’s UI, and to justify the rationale behind your design choices.

Note that typically you would receive a wireframe with the layouts required as well as a graphic kit with icons, banners and other GUI elements, so you will not be assessed on your graphical capabilities. Feel free to make your own, but we are looking simply for a clean, functional layout and you will be assessed on functionality, technologies used, code written, and perhaps some creativity.

For your reference, our website is at http://www.fortytwo.com.
