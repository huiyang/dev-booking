<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var json = {!! $json !!};
    var url = '{{ $url }}';

    console.log('json', json);
    console.log('url', url);

    axios.post(url, json).then((response) => {
        alert('success');
    }).catch((error) => {
        alert('error');
        console.error(error);
    });
</script>