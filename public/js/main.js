document.getElementById("filtrer").addEventListener("click", function () {

    const prixMax = document.getElementById("prixMax").value;
    const theme = document.getElementById("theme").value;
    const regime = document.getElementById("regime").value;

    const menus = document.querySelectorAll(".menu-card");

    menus.forEach(function(menu) {

        const prix = Number(menu.dataset.prix);
        const menuTheme = menu.dataset.theme;
        const menuRegime = menu.dataset.regime;

        let visible = true;

        if (prixMax !== "" && prix > Number(prixMax)) {
            visible = false;
        }

        if (theme !== "" && menuTheme !== theme) {
            visible = false;
        }

        if (regime !== "" && menuRegime !== regime) {
            visible = false;
        }

        menu.style.display = visible ? "block" : "none";

    });

});