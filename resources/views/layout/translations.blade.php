<script>
    window.language = "{{ App::getLocale() }}";
    let translations = @php include_once(resource_path('lang/' . app('translator')->getLocale() . '.json')) @endphp;
</script>