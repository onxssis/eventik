let file = document.getElementById('event-file');

if (file) {
    file.onchange = function() {
        if (file.files.length > 0) {
            document.querySelector('span.file-name').innerHTML =
                file.files[0].name;
        }
    };
}
