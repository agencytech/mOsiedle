<!DOCTYPE html>
<html lang="pl">
    <?php include 'components/head.php'; ?>
    <body>
        
    </body>
</html>
<script>
    function openSite(site) {
    var body = document.body;
    // body.innerHTML = "<div class='w-full flex items-center justify-center z-[999]'><div class='z-[30] bg-black/90 p-4 rounded-xl'><div class='lds-dual-ring'></div></div></div>";
    const url = "pages/" + site + ".php";
    fetch(url)
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const parsedDocument = parser.parseFromString(data, "text/html");
            body.innerHTML = parsedDocument.body.innerHTML;

            // Wywołaj funkcję do wykonania skryptów
            executeScripts(parsedDocument);

            // Dodaj nowy wpis do historii przeglądarki
            const newUrl = window.location.origin + window.location.pathname + "?" + site;
            history.pushState({ path: newUrl }, "", newUrl);
        });
    // Zapisz URL w localStorage
    localStorage.setItem("mOsiedle", site);
}

function executeScripts(parsedDocument) {
    // Przechodź przez znalezione skrypty i wykonuj je
    const scripts = parsedDocument.querySelectorAll("script");
    scripts.forEach(script => {
        const scriptElement = document.createElement("script");
        scriptElement.textContent = script.textContent;
        document.body.appendChild(scriptElement);
    });
}

var site = localStorage.getItem("mOsiedle");
if (site == null) {
    openSite('landing_page');
} else {
    openSite(site);
}

//    function openSite(site) {
//     var body = document.body;
//     // body.innerHTML = "<div class='w-full flex items-center justify-center z-[999]'><div class='z-[30] bg-black/90 p-4 rounded-xl'><div class='lds-dual-ring'></div></div></div>";
//     const url = "pages/" + site + ".php";
//     fetch(url)
//         .then(response => response.text())
//         .then(data => {
//             const parser = new DOMParser();
//             const parsedDocument = parser.parseFromString(data, "text/html");
//             body.innerHTML = parsedDocument.body.innerHTML;
//             // Przechodź przez znalezione skrypty i wykonuj je
//             const scripts = parsedDocument.querySelectorAll("script");
//             scripts.forEach(script => {
//                 const scriptElement = document.createElement("script");
//                 scriptElement.textContent = script.textContent;
//                 document.body.appendChild(scriptElement);
//             });

//             // Dodaj nowy wpis do historii przeglądarki
//             const newUrl = window.location.origin + window.location.pathname + "?" + site;
//             history.pushState({ path: newUrl }, "", newUrl);
//         });
//     // Zapisz URL w localStorage
//     localStorage.setItem("mOsiedle", site);
// }

//     var site = localStorage.getItem("mOsiedle");
//     if (site == null) {
//         openSite('landing_page');
//     } else {
//         openSite(site);
//         // var removeButtons = document.querySelectorAll("#dashboard");
//         // for (var i = 0; i < removeButtons.length; i++) {
//         // removeButtons[i].classList.remove("sidenav-button-active");
//         // }

//         // var activeButtons = document.querySelectorAll("#" + panelPage.replace("components/panel/", "").replace(".php", ""));
//         // for(var i = 0; i < activeButtons.length; i++) {  
//         // activeButtons[i].classList.add("sidenav-button-active");
//         // }
        
//     }
</script>