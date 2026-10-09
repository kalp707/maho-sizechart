/**
 * Maho Size Chart — vanilla JS + daisyUI dialog modal
 * SPDX-License-Identifier: OSL-3.0
 */
(() => {
    'use strict';

    const SELECTOR_OPEN = '[data-sizechart-open]';
    const MODAL_ID = 'sizechart-modal';

    const onReady = (callback) => {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', callback, { once: true });
            return;
        }
        callback();
    };

    onReady(() => {
        const modal = document.getElementById(MODAL_ID);
        if (!(modal instanceof HTMLDialogElement)) {
            return;
        }

        const openModal = (event) => {
            if (event) {
                event.preventDefault();
            }
            if (typeof modal.showModal === 'function') {
                modal.showModal();
            }
        };

        document.addEventListener('click', (event) => {
            const openTrigger = event.target.closest(SELECTOR_OPEN);
            if (openTrigger) {
                openModal(event);
            }
        });
    });
})();
