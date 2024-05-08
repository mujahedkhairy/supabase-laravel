const supabase = createClient('https://vzvtfhtecjngindxjvmy.supabase.co', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InZ6dnRmaHRlY2puZ2luZHhqdm15Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3MTUwOTQ5MDIsImV4cCI6MjAzMDY3MDkwMn0.9Ta6t7ClyjnI-7z8FfwbZ0c4EoPGyuawAf9RUN3Fguo');

    const channel = supabase
        .channel('schema--public')
        .on('postgres_changes', { event: '*', schema: 'public' }, payload => {
            console.log(payload);
        })
        .subscribe();