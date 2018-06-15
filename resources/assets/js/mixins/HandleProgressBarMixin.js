import { mapGetters } from "vuex";

export default {
    computed: {
        ...mapGetters(["resume"])
    },

    mounted() {
        const _this = this;

        !(function($) {
            "use strict";

            const progressbar = $("#resume-completion-progress").find("div");
            const tabs = $("#resume-sections-tabs");

            tabs.on(
                "shown.bs.tab",
                '.nav-item a[data-toggle="tab"]',
                function() {
                    const activeSectionIndex = _this.resume.getActiveSection(
                        true
                    );
                    const totalSections = _this.resume.getSections().length;
                    const completion = Math.floor(
                        (activeSectionIndex + 1) / totalSections * 100
                    );

                    progressbar.attr("aria-valuenow", completion);
                    progressbar.css({ width: completion + "%" });
                }
            );
        })(window.jQuery);
    }
};
