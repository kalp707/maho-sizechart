(function () {
    'use strict';

    function ready(fn) {
        if (document.readyState !== 'loading') {
            fn();
            return;
        }
        document.addEventListener('DOMContentLoaded', fn);
    }

    ready(function () {
        var modal = document.getElementById('sizechart-modal');
        if (!modal) {
            return;
        }

        var openers = document.querySelectorAll('[data-sizechart-open]');
        var closers = modal.querySelectorAll('[data-sizechart-close]');
        var previouslyFocused = null;

        function openModal(event) {
            if (event) {
                event.preventDefault();
            }
            previouslyFocused = document.activeElement;
            modal.hidden = false;
            document.body.classList.add('sizechart-modal-open');
            var closeBtn = modal.querySelector('.sizechart-modal__close');
            if (closeBtn) {
                closeBtn.focus();
            }
        }

        function closeModal() {
            modal.hidden = true;
            document.body.classList.remove('sizechart-modal-open');
            if (previouslyFocused && typeof previouslyFocused.focus === 'function') {
                previouslyFocused.focus();
            }
        }

        Array.prototype.forEach.call(openers, function (el) {
            el.addEventListener('click', openModal);
        });

        Array.prototype.forEach.call(closers, function (el) {
            el.addEventListener('click', closeModal);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && !modal.hidden) {
                closeModal();
            }
        });
    });
})();
