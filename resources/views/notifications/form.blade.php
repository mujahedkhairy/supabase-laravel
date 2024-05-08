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

<!-- Initialize Supabase client and setup subscriptions -->
<script>
    const supabase = createClient('https://vzvtfhtecjngindxjvmy.supabase.co', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InZ6dnRmaHRlY2puZ2luZHhqdm15Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3MTUwOTQ5MDIsImV4cCI6MjAzMDY3MDkwMn0.9Ta6t7ClyjnI-7z8FfwbZ0c4EoPGyuawAf9RUN3Fguo');

    const channel = supabase
        .channel('schema--public')
        .on('postgres_changes', { event: '*', schema: 'public' }, payload => {
            console.log(payload);
        })
        .subscribe();
</script>
</body>
</html>
