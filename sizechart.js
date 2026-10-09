/**
 * Maho Size Chart — vanilla JS modal
 * SPDX-License-Identifier: GPL-3.0-or-later
 */
(() => {
    'use strict';

    const SELECTOR_OPEN = '[data-sizechart-open]';
    const SELECTOR_CLOSE = '[data-sizechart-close]';
    const MODAL_ID = 'sizechart-modal';
    const BODY_OPEN_CLASS = 'sizechart-modal-open';

    const onReady = (callback) => {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', callback, { once: true });
            return;
        }
        callback();
    };

    onReady(() => {
        const modal = document.getElementById(MODAL_ID);
        if (!modal) {
            return;
        }

        let previouslyFocused = null;

        const openModal = (event) => {
            if (event) {
                event.preventDefault();
            }

            previouslyFocused = document.activeElement;
            modal.hidden = false;
            document.body.classList.add(BODY_OPEN_CLASS);

            const closeBtn = modal.querySelector('.sizechart-modal__close');
            if (closeBtn) {
                closeBtn.focus();
            }
        };

        const closeModal = () => {
            if (modal.hidden) {
                return;
            }

            modal.hidden = true;
            document.body.classList.remove(BODY_OPEN_CLASS);

            if (previouslyFocused && typeof previouslyFocused.focus === 'function') {
                previouslyFocused.focus();
            }
            previouslyFocused = null;
        };

        // Event delegation keeps handlers working if links are re-rendered
        document.addEventListener('click', (event) => {
            const openTrigger = event.target.closest(SELECTOR_OPEN);
            if (openTrigger) {
                openModal(event);
                return;
            }

            const closeTrigger = event.target.closest(SELECTOR_CLOSE);
            if (closeTrigger && modal.contains(closeTrigger)) {
                closeModal();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    });
})();
