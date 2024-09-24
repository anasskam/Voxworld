# VoxWorld

**VoxWorld** is a dynamic e-newspaper platform built with **PHP** and **JavaScript**, designed to provide a seamless experience for both users and administrators. It offers an interactive space for news consumption, content discussion, and efficient content management.

## Features

### User Interface (User Side)
- **Browse Articles**: Stay informed by exploring the latest articles, categorized for easy navigation.
- **Interactive Discussions**: Engage with the content by leaving comments and participating in discussions.
- **Share Content**: Share your favorite articles with friends and on social media.

### Admin Interface
- **Article Management**: Create, edit, and publish articles with ease.
- **User Management**: Add, remove, or edit user roles and permissions.

## Technology Stack
- **Frontend**: JavaScript, HTML5, CSS3
- **Backend**: PHP, MySQL
- **Other Tools**: AJAX for real-time updates, JSON for data interchange, CKEditor for rich-text editing

## Installation

### Prerequisites
- PHP 7.4 or later
- MySQL 5.7 or later
- A web server like Apache or Nginx

### Steps
1. Clone the repository:
2. 
   ```bash
   git clone projectUrl
   
3. Navigate to the project directory:
   
   ```bash
   cd voxworld
   
4. Set up the database:
   - Create a new MySQL database name it **journal**
   - Import the provided SQL dump file into the database:
   
   ```bash
   mysql -u yourusername -p yourdatabase < database/journal.sql
   
5. Start the web server and visit the application at **http://localhost/voxworld**

### Usage
- **For Users**: Once registered, users can browse articles, leave comments, and share articles directly from the platform.
- **For Admins**: After logging in, admins can access the dashboard to manage content, users.

### License
- VoxWorld is licensed under the MIT License.

