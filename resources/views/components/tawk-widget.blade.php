@php
    $tawkEnabled = (bool) config('services.tawk.enabled');
    $tawkPropertyId = trim((string) config('services.tawk.property_id'));
    $tawkWidgetId = trim((string) config('services.tawk.widget_id'));
    $tawkReady = $tawkEnabled && $tawkPropertyId !== '' && $tawkWidgetId !== '';
@endphp

@if($tawkReady)
    <script type="text/javascript">
        window.Tawk_API = window.Tawk_API || {};
        window.Tawk_LoadStart = new Date();

        window.Tawk_API.onLoad = function () {
            try {
                window.Tawk_API.setAttributes({
                    page_title: @json($title ?? config('app.name')),
                    current_url: @json(url()->current()),
                }, function () {});
            } catch (e) {}
        };

        (function () {
            var s1 = document.createElement("script");
            var s0 = document.getElementsByTagName("script")[0];

            s1.async = true;
            s1.src = "https://embed.tawk.to/{{ $tawkPropertyId }}/{{ $tawkWidgetId }}";
            s1.charset = "UTF-8";
            s1.setAttribute("crossorigin", "*");
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
@endif
