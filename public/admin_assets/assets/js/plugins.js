var script = document.createElement("script");
script.src = "https://cdn.jsdelivr.net/npm/toastify-js";
script.async = true;
script.defer = true;

(document.querySelectorAll("[toast-list]") ||
    document.querySelectorAll("[data-choices]") ||
    document.querySelectorAll("[data-provider]")) &&
    (document.head.appendChild(script),
    document.writeln(
        "<script type='text/javascript' src='admin_assets/assets/libs/choices.js/public/assets/scripts/choices.min.js'></script>"
    ),
    document.writeln(
        "<script type='text/javascript' src='admin_assets/assets/libs/flatpickr/flatpickr.min.js'></script>"
    ));
