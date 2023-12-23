document.addEventListener("DOMContentLoaded", function () {
    function shopFilter() {
        const filterElements = {
            "kitchen": document.querySelectorAll(".kitchen"),
            "livingroom": document.querySelectorAll(".livingroom"),
            "personal": document.querySelectorAll(".personal"),
        };

        var filterBtns = document.querySelectorAll(".filterIcon");

        filterBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                if (btn.classList.contains("active")) {
                    filterBtns.forEach(function (innerBtn) {
                        innerBtn.classList.remove('deselected');
                        innerBtn.classList.remove('active');
                    });
                    for (const category in filterElements) {
                        const element = filterElements[category];
                        element.forEach(function (item) {
                            item.classList.remove('inactive');
                            item.classList.remove('active');
                        });
                    }
                } else {
                    filterBtns.forEach(function (innerBtn) {
                        innerBtn.classList.remove('deselected');
                        innerBtn.classList.remove('active');
                        if (innerBtn !== btn) {
                            innerBtn.classList.add('deselected');
                        }
                    });
                    this.classList.add('active');
                    toggleFilter(this.dataset.category);
                }
            });
        });

        function toggleFilter(category) {
            for (const i in filterElements) {
                const element = filterElements[i];
                element.forEach(function (item) {
                    if (item.classList.contains(category)) {
                        item.classList.remove('inactive');
                        item.classList.add('active');
                    } else {
                        item.classList.remove('active');
                        item.classList.add('inactive');
                    }
                });
            }
        }

        return filterElements;
    }

    shopFilter();
});
