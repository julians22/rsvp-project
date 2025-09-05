@if (config('analytics.google.enabled') && config('analytics.google.id'))
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('analytics.google.id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag("config", "{{ config('analytics.google.id') }}");
    </script>
@endif
