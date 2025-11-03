    document.addEventListener("DOMContentLoaded", function() {
      // Substitui todas as classes de ícones por novos ícones e cor roxo claro
      const iconMap = {
        "fa-star": "fa-gem",
        "fa-list": "fa-layer-group",
        "fa-box": "fa-cube",
        "fa-user": "fa-user-circle",
        "fa-map-marker-alt": "fa-location-dot",
        "fa-shopping-cart": "fa-basket-shopping",
        "fa-bars": "fa-grip-lines"
      };
      document.querySelectorAll("i.fas").forEach(function(icon) {
        for (const oldIcon in iconMap) {
          if (icon.classList.contains(oldIcon)) {
            icon.classList.remove(oldIcon);
            icon.classList.add(iconMap[oldIcon]);
          }
        }
        icon.classList.add("icon-roxo-claro");
      });
    });