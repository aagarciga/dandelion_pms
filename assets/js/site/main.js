/*
 * Welcome to your app's site main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (site.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
// noinspection JSLint
import "../../css/site/style.scss";

import gsap from "gsap";
import barba from "@barba/core";
import documentReady from "./core/documentReady";
import keyboardNavigation from "./core/keyboardNavigation";

// import scrollmagic from 'scrollmagic';
// import $ from 'jquery';

class SiteApp {

    static htmlBindings() {
        return {
            pageTransitionAnimationClass: "page-transition__animating",
            pageTransitionFinishedClass: "page-transition__finished"
        };
    }

    static start(debug = false) {
        return new SiteApp(debug);
    }

    static pageTransitionFinished() {
        window.document.documentElement.classList.add(SiteApp.htmlBindings().pageTransitionFinishedClass);
    }

    constructor(debug) {
        this.debug = debug || false;
        if (this.debug) {
            window.console.info("Site Application:constructor");
        }
        this.init();
    }

    init() {
        if (this.debug) {
            window.console.info("Site Application:init");

            try {
                this.barbaHooks();
                this.barbaInit(this.debug);
                this.pageInit();
            } catch (error) {
                if (this.debug) {
                    window.console.error("Site Application:init:", error);
                    throw error;
                }
            }
        }
        SiteApp.pageTransitionFinished();
    }

    pageInit() {
        keyboardNavigation(".main-nav > a", window, this.debug);
    }

    barbaHooks(debug = false) {
        if (debug) {
            window.console.info("Site Application:barbaHooks");
        }
        barba.hooks.before(() => {
            barba.wrapper.classList.add(SiteApp.htmlBindings().pageTransitionAnimationClass);
        });
        barba.hooks.after(() => {
            barba.wrapper.classList.remove(SiteApp.htmlBindings().pageTransitionAnimationClass);
        });
    }

    barbaInit(debug = false) {
        if (debug) {
            window.console.info("Site Application:barbaInit");
        }
        let self = this;
        barba.init({
            transitions: [{
                name: "page-transition",
                leave: function (data) {
                    if (debug) {
                        window.console.info("Site Application:page:transition:leave:", data);
                    }

                    let done = this.async();
                    let tl = gsap.timeline();

                    tl
                        .addLabel("start")
                        .to(".page-transition-top-wipe", {
                            duration: 1,
                            y: "100%",
                            // ease: 'power2.in',
                            onComplete: done
                        }, "start")
                        .set(data.current.container, {
                            height: 0
                        });
                },
                enter: function (data) {
                    if (debug) {
                        window.console.info("Site Application:page:transition:enter:", data);
                    }
                    let done = this.async();

                    gsap.to(".page-transition-top-wipe", {
                        duration: 1,
                        y: "-100%",
                        // ease: 'power2.out',
                        onComplete: done
                    });
                    self.pageInit();
                }
            }]
        });
    }
}

documentReady(() => {
    SiteApp.start(true);
}, window);


