# Authoring-System
## GROUP MEMBERS
  - KELLY TAN KAI LING (20310184)
  - CHAN JIN SHUAN (20307136)
  - IBRAHIM FAIZ (20314682)

## Description

- This repository contains the source code for a functional website interface that interacts with a pre-determined given dataset in a MySQL database. 

- The aim of this project was to develop an authoring system that serves as a creation and publishing tool for a LMS. The system is designed to enable untrained personnel to create and edit courses, organize content without specialized technical skills, and provide an overall user-friendly interface.

## Tech/Framework Used

- For this project, XAMPP was used, which is an open-source web server that integrates with Apache and MySQL. 

- The system's database, named studiodb, was developed using MySQL version 5.0.37 through the XAMPP server.

- The Database folder contains the studiodb.sql file, which is used for the system's database.

- The Dev folder contains all the necessary .js and .php files required to operate the system. These files are further organized into seven subfolders (Login, Signup, ForgotPassword, Dashboard, Topic, Profile, Theme). Each of these subfolders is responsible for specific functions within the system. Dev folder contains crucial system files such as: config.php for database connection, head.php for initialization, navbar.php for navigation, and session.php for login verification.

- The following languages were used in the development of this project:

	- HTML for content markup
	- CSS for styling
	- JavaScript for mobile and desktop responsiveness
	- PHP for server-side scripting
	- SQL for database management

- The following frameworks were used to develop the system's user interface:

	- Bootstrap was used for styling and provided pre-built components such as pop-up modals, accordions, and tooltips.
	- jQuery was used for event handling, animation, AJAX requests, and displaying popup messages or notifications with the .jGrowl plugin.


## Features

Below is a list of key features that have been implemented in this project:

- Login, Signup, Forgot Password Page
	-- Functional account registration
	-- Includes forgotten password feature with security questions

- Dashboard Page
	-- Create, edit, delete, clone and search functions
	-- View list of created courses
	-- Settings menu including profile, learner’s view and dark or light theme
	-- Allows users to log out
	
- Topic Page
	-- Drag and drop uploading
	-- File categories
	-- File previews
	-- List and grid view for files
	
- Profile Page
	-- Edit profile details
	-- Edit security questions
	-- Reset password
	-- Shows total courses and topics created


## Installation

- Download and install XAMPP (or another local server software) on your computer.
- Download or clone the project files from the GitHub repository.
- Extract the project files to the htdocs folder of your XAMPP installation directory (e.g., C:\xampp\htdocs).
- Open XAMPP and start the Apache and MySQL services.
- Import the MySQL database provided in the project files into your local MySQL server using a tool such as phpMyAdmin.
- Update the database connection details in the config.php file located in the Dev folder to match your local MySQL server credentials.
- Open a web browser and navigate to http://localhost/your-project-folder to access the authoring system.


