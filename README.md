# Event Booking System

This application implements an event booking system using Laravel’s default codebase structure.

## Overview

The system is built with a repository design pattern and offers RESTful API functionalities, including:

### Authentication
- **Register**
- **Login**

### Event Management
- **Create, Read, Update, Delete (CRUD)**

### Booking
- **Book an Event**
- **View Bookings**

### Booking Discounts
- **Create, Read, Update, Delete (CRUD)**

---

## Database Design

The database design comprises the following entities:

### Models and Attributes

#### Event Model:
- **id**: Primary key
- **user_id**: Owner of the event
- **title**: Event title
- **description**: Detailed information about the event
- **guests_counter**: Number of guests currently registered
- **capacity**: Maximum allowed guests
- **status**: Event status (e.g., active, canceled)
- **start_date**: Event start date
- **end_date**: Event end date
- **prices**: Pricing details based on ticket types

#### Ticket Type:
- **id**: Primary key
- **event_id**: Foreign key linking to the event
- **description**: Ticket type details
- **price**: Cost of the ticket

#### Booking Model:
- **id**: Primary key
- **event_id**: Foreign key linking to the event
- **user_id**: User making the booking
- **booking_date**: Date of booking
- **total_guests**: Number of tickets booked
- **guest_name**: Name of the guest(s)
- **guest_email**: Email of the guest(s)
- **total_price**: Total booking cost
- **prices**: Breakdown of ticket costs

#### Booking Discounts:
- **id**: Primary key
- **description**: Discount description
- **rule**: Discount rule logic
- **invert**: Flag for negating discount rules

---

### Relationships

- **One-to-Many**: An event can have multiple ticket types.
- **One-to-One**: A booking corresponds to one event.
- **Many-to-Many**: An event can have multiple discount rules.

### Data Diagram
Below is a visual representation of the main relationships in the database:

```
Event [1] ----- [*] TicketType

Event [1] ----- [1] Booking

Event [*] ----- [*] BookingDiscounts
```

---

## Deployment Guide

### System Requirements
To run the application, you need:
- [Git](https://git-scm.com/downloads)
- [Docker](https://www.docker.com/) and [Docker Compose](https://docs.docker.com/compose/install/)

### Steps to Deploy
1. Clone the project from GitHub and navigate to the application directory:
   ```bash
   git clone git@github.com:mamounothman/event_system.git
   cd event_system
   ```

2. Build the Docker images and start the containers:
   ```bash
   docker-compose up --build
   ```

3. Access the application locally via `http://localhost:8000`.

### Testing the API
To simplify testing, the application includes [Scramble (Swagger) Documentation Generator](https://scramble.dedoc.co/). Visit the [API Docs](http://localhost:8000/docs/api) to explore and test the endpoints.

#### Example: Register Endpoint
Use the Swagger UI to test the register endpoint by sending the following JSON payload:

```json
{
  "name": "John Doe",
  "email": "johndoe@email.com",
  "password": "password",
  "password_confirmation": "password"
}
```

Click the `Send API Request` button to view the response in the example section.

---

This documentation provides a comprehensive guide for understanding, deploying, and testing the event booking system.

