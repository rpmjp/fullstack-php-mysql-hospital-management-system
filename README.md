# 🏥 NMA Clinic Management System

A full-stack web application designed to simulate the operations of a real-world healthcare clinic. Built using **PHP**, **MySQL**, **HTML/CSS**, and **JavaScript**, this system includes full role-based access control and modular backend architecture. It was created as part of a graduate-level database systems project, showcasing advanced skills in system design, database normalization, and web development.

---

## 🚀 Features

- **Patient Management**  
  Register patients, assign a primary care physician, track admissions, link allergies and illnesses, and manage discharges.

- **Staff Management**  
  Add and manage physicians, surgeons, nurses, and support staff. Assign specialties, certifications, and job shifts.

- **Inpatient & Room Assignment**  
  Assign beds, rooms, and nursing units. Schedule admissions and discharges, and assign nurses for ongoing care.

- **Surgery Scheduling**  
  Allocate surgery rooms, assign surgical staff with required skills, and track completed procedures.

- **Medication Tracking**  
  Manage medication inventory and automatically enforce drug interaction rules using a dedicated interaction table.

- **Consultations & Diagnoses**  
  Record consultation notes, link allergies and illnesses per visit, and track patient history over time.

- **Secure Login System**  
  Role-based access for administrators, physicians, nurses, surgeons, and support staff.

---

## 🧰 Tech Stack

- **Frontend**: HTML, CSS, JavaScript, Inputmask.js  
- **Backend**: PHP (Custom-built, no framework)  
- **Database**: MySQL (20+ normalized tables)  
- **Tools**: VS Code, phpMyAdmin, XAMPP, GitHub  

---

## 🗄️ Database Design

The MySQL schema is fully normalized (3NF) and includes over 20 interrelated tables, such as:

- `PATIENT`, `PHYSICIAN`, `SURGEON`, `NURSE`, `SUPPORT_STAFF`
- `ILLNESS`, `ALLERGY`, `CONSULTATION`, `PATIENT_ILLNESS`, `PRIMARY_CARE`
- `IN_PATIENT`, `ROOM`, `PATIENT_CARE`, `SHIFT_SCHEDULE`
- `SURGERY_TYPE`, `SURGERY_ASSIGN`, `SURGERY_RECORD`
- `MEDICATION`, `DRUG_INTERACTION`

Key design features:

- 🔗 **Many-to-many relationships** with join tables  
- 🛡️ **Foreign key constraints** to ensure data integrity  
- 💊 **Medication safety logic** via drug interaction enforcement  
- 🏥 **ISA relationships** for healthcare staff specialization  

---

## ⚙️ Setup Instructions

1. **Clone the repository**:
   ```bash
   git clone git clone https://github.com/rpmjp/fullstack-php-mysql-hospital-management-system.git

