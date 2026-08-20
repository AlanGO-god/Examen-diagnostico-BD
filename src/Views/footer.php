</main>
    <script>
        function switchView(viewId) {
            const panels = document.querySelectorAll('.view-panel');
            panels.forEach(panel => panel.classList.remove('active-view'));

            const menuItems = document.querySelectorAll('.menu-section li');
            menuItems.forEach(item => item.classList.remove('active'));

            document.getElementById(viewId).classList.add('active-view');

            const clickedOption = event.currentTarget;
            clickedOption.classList.add('active');
        }
    </script>
</body>
</html>