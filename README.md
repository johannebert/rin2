# About RIN2 - Web app with Notifications

An application that allows users t- see special posts as a one-time notification.

## For Installation check [INSTALLATION.md](INSTALLATION.md)

### Requirements
- Having a basic user’s table (i.e. the one form standard Laravel auth migrations).
  - Setup the DB, migrate and add some records.
- Adapt and prepare the structure to handle the notifications and identify when a user reads them.
  - Do the new database migrations for “users” considering that the table is already migrated, seeded and in production.
    - Add the notification switch as not null
    - Add the phone number as nullable
  - **2024_05_02_100134_add_new_columns_users.php** located in database/migrations


### The app will need:
- a page to list users and see how many notifications are still to be read.
  - List user basic info, plus the unread notification count.
  - [Users](https://rin2.test/users)
  - Click on a user to “impersonate him” and see a simple home page with the classic notification icon with unread counter on the top-bar.
    - Click on the counter to see the notification list.
    - Click on the notification to set it as read.
    

- a form to update a user’s notifications settings
  - Switch on-screen notifications on/off
  - Change Email
  - Change Phone number (validated as real mobile number with any free 3rd party library i.e. messagebird)
  - https://github.com/Propaganistas/Laravel-Phone for Validation
- [Profile](https://rin2.test/profile)


- a page to post new notifications
  - Notifications should have
      - a type: marketing, invoices, system
      - a short text
      - an expiration, after which it won’t appear on users pages also if unread
      - a destination: to a specific user or for all
      - [Notifications](https://rin2.test/notifications) for specific user
      - [Notify](https://rin2.test/notifications/create) for all users
    

- We need a page to list the posted notifications with detail
- The web application should provide a working PoC of:
  - A User settings editor: [Profile](https://rin2.test/profile)
  - A way to list users and notifications entries with filters. [Users](https://rin2.test/users) , [Notifications](https://rin2.test/notifications)
  - A solution to manually post new notifications items. [Notify](https://rin2.test/notifications/create)

### Tools
- [Herd Laravel](https://herd.laravel.com/) for local development
- Laravel v.11
- PHP v8.3
- MySQL
- Alpine.js
- Livewire v3
- TailwindCSS v3
