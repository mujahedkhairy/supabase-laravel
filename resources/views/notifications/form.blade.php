<!DOCTYPE html>
<html>
<head>
    <title>Send Notification</title>
  <!-- Load the Supabase JS library -->


</head>
<body>
    <h1>Send Notification to All Users</h1>
    <form method="POST" action="{{ url('/send_notification_all') }}">
        @csrf  <!-- CSRF Token for Laravel form submission -->
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="message">Message:</label><br>
        <textarea id="message" name="message" required></textarea><br><br>

        <button type="submit">Send Notification</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js"></script>
    <script src="{{ asset('js/supabase-init.js') }}"></script>
</body>
</html>
