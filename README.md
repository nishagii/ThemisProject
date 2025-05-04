# Themis - Lawyer Case Management System

A comprehensive and secure legal case management system designed to streamline case tracking, client communication, legal research, and payment processing for law firms in Sri Lanka.

## 📌 Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Goals and Objectives](#goals-and-objectives)
- [System Architecture](#system-architecture)
- [Technologies Used](#technologies-used)
- [Feasibility Study](#feasibility-study)
- [Requirements](#requirements)
- [Design Diagrams](#design-diagrams)
- [Project Completion](#project-completion)

---

## 📖 Introduction

This system addresses inefficiencies in traditional legal workflows used by Sri Lankan legal professionals. It replaces manual systems (diaries, spreadsheets, WhatsApp, etc.) with a centralized and collaborative digital solution.

---

## 🚀 Features

| Feature                  | Manual System | International Tools | Our System                      |
|--------------------------|---------------|---------------------|---------------------------------|
| Case Details             | Diaries, notes| Software-based      | Centralized system              |
| Communication            | WhatsApp      | Not integrated      | Built-in chat                   |
| Legal Citations          | Manual search | Limited tools       | Smart legal search with filters |
| Payment Management       | Cash/Cheque   | Integrated gateways | Stripe & PayHere integration    |
| Schedule Management      | Diaries       | Calendar integration| Built-in FullCalendar support   |

---

## 🎯 Goals and Objectives

1. Centralize case management
2. Enhance team collaboration
3. Ensure data security
4. Automate scheduling and deadlines
5. Improve accessibility via mobile-responsiveness
6. Enhance client communication
7. Support legal research with citation tools
8. Promote a user-friendly interface

---

## 🏗️ System Architecture

The system follows the **MVC architecture**:
- **Model:** Handles business logic and database interactions
- **View:** User interface (HTML, CSS, JavaScript)
- **Controller:** Manages requests and routes between model and view

---

## 🛠️ Technologies Used

- **Frontend:** HTML, CSS, JavaScript, FullCalendar.js
- **Backend:** PHP (MVC Architecture)
- **Database:** MySQL
- **Payment Gateways:** Stripe
- **Other Tools:** Google Calendar API, AI search for legal citations

---

## 🧪 Feasibility Study

- **Social:** Supports digital transformation in the legal sector
- **Technical:** Built using well-supported open-source technologies
- **Economic:** Cost-effective compared to foreign SaaS solutions
- **Legal/Ethical:** Ensures secure storage and ethical handling of client data

---

## 📋 Requirements

### Actors
- Lawyer
- Junior Lawyer
- Attorney
- Admin
- Client
- Precedent Manager

### Functional Requirements
- Add/View/Edit/Delete cases
- Schedule hearings and deadlines
- Integrate payment gateways
- Search legal documents
- Client communication

### Non-functional Requirements
- High usability and accessibility
- Secure authentication
- Fast response time

---

## 🔍 Design Diagrams

- Use Case Diagram
- Class Diagram
- Entity Relationship (ER) Diagram
- Activity Diagram

(*See the `/docs` directory for images and source diagrams*)

---

## ✅ Project Completion

- ✅ Core features implemented
- ✅ Payment system integrated
- ✅ Calendar and scheduling working

---

## 📂 Repository Structure
```
.
├── app/
│   ├── controllers/        # Handles incoming HTTP requests and calls model logic
│   ├── models/             # Business logic and database interaction
│   └── views/              # PHP views rendered for different user roles
├── public/                 # Publicly accessible assets (CSS, JS, images)
├── docs/
│   └── design-diagrams/    # System design diagrams and documentation
├── README.md               # Project overview and setup instructions
└── database.sql            # SQL script to set up database schema

```
---

---

## 📬 Contact

For further inquiries or demo requests, please contact the project team at: [click here](jeewanthadeherath04@gmail.com)


