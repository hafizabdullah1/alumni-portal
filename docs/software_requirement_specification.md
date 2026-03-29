# Software Requirement Specification (SRS)

## 1. Introduction
The Alumni Portal for the University of Loralai is a web-based system designed to facilitate communication and networking between alumni, students, and administration, while automating administrative processes.

## 2. Functional Requirements

### 2.1 User Roles & Authentication
- **Admin**: Full access to all modules, user verification, and file tracking.
- **Alumni**: Can register, manage profiles, and interact with students.
- **Student**: Can view alumni, seek mentorship, and access exam results.

### 2.2 Alumni Module
- **Registration & Profile**: Alumni must register and be verified by the Admin.
- **Job/Internship Portal**: Alumni can post and manage job/internship opportunities.
- **Networking**: Search for other alumni and students.

### 2.3 Student Module
- **Dashboard**: Overview of university news and mentorship opportunities.
- **Mentorship**: Request guidance from verified alumni.
- **Alumni Directory**: View and search verified alumni profiles.

### 2.4 Admin Dashboard
- **User Management**: Approve/verify alumni registrations and manage student/alumni accounts.
- **Data Management**: Upload university news, announcements, and examination results.
- **System Monitoring**: Overview of file tracking status across departments.

### 2.5 File Tracking System
- **Document Creation**: Initiate a "file" with a unique tracking ID.
- **Movement Tracking**: Log the movement of files between different university departments.
- **Status Updates**: Real-time status (Pending, In Progress, Completed, Stuck).

### 2.6 Online Examination Result Integration
- **Result Upload**: Admin uploads results in a standardized format.
- **Secure Viewing**: Students can view only their own results using secure credentials.

## 3. Non-Functional Requirements
- **Security**: Role-based access control (RBAC) and encrypted passwords.
- **Scalability**: Capable of handling hundreds of concurrent users.
- **Responsiveness**: Mobile-friendly UI using Laravel Blade and CSS.
- **Integrity**: Audit logs for file movements and administrative actions.

## 4. User Stories
### 4.1 As an Alumnus
- I want to register and get verified so I can give back to the university community.
- I want to post job opportunities to help current students find employment.

### 4.2 As a Student
- I want to see my examination results online so I don't have to visit the campus.
- I want to find a mentor among the alumni to guide my career path.

### 4.3 As an Admin
- I want to verify alumni profiles to ensure the platform remains professional.
- I want to track department files digitally to improve administrative efficiency.
