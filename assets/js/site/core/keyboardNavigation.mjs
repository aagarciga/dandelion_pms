export default function keyboardNavigation(navigationElementSelector, global, debug = false) {

    if (debug) {
        global.console.info(`Site Application:keyboardNavigation:selector('${navigationElementSelector}')`);
    }
    global = global || window;
    const renderStateClass = "render";
    const navigationElements = Array.from(global.document.querySelectorAll(navigationElementSelector));
    const navigationCount = navigationElements.length;
    const currentPageIndex = navigationElements.findIndex(function (element) {
        return element.classList.contains("current-page");
    });
    if (debug) {
        global.console.info(`Site Application:keyboardNavigation:currentPageIndex('${currentPageIndex}')`);
    }
    const navigate = function (linkElement) {
        global.document.body.classList.remove(renderStateClass);
        global.location = linkElement.href;
    };

    setTimeout(function () {
        global.document.body.classList.add(renderStateClass);
    }, 60);
    navigationElements.forEach(function (link) {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            navigate(event.target);
        });
    });
    global.document.addEventListener("keydown", function (event) {
        if (event.defaultPrevented) {
            return; // Alex: Should do nothing if the default action has been cancelled
        }
        let linkElement;
        let handled = false;
        if (event.key !== undefined || event.keyCode !== undefined || event.which) {
            const keyName = event.key;
            const keyCode = event.keyCode || event.which;
            if (keyName === "ArrowLeft" || keyCode === 37) {
                if (debug) {
                    global.console.info("Pressed [Left] key with code:", event.key, keyCode);
                }
                linkElement = (currentPageIndex > 0) ? navigationElements[currentPageIndex - 1] : navigationElements[navigationCount - 1];
            } else if (keyName === "ArrowRight" || keyCode === 39) {
                if (debug) {
                    global.console.info("Pressed [Right] key with code:", event.key, keyCode);
                }
                linkElement = currentPageIndex < navigationCount - 1 ? navigationElements[currentPageIndex + 1] : navigationElements[0];
            } else {
                return false;
            }
            handled = true;
        }

        if (handled) {
            // Alex: suppress "double action" if event handled
            event.preventDefault();
            navigate(linkElement);
        }

    }, true);
}
