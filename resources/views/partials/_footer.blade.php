        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© 2017-2018 {{ config('app.name', 'Resume Builder') }}</p>
            
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>

        @stack('app_footer')

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
