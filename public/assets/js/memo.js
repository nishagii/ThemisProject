            // Select all elements that can open a modal
            const openModalButtons = document.querySelectorAll('[data-modal-target]');

            // Function to open a modal
            function openModal(popup) {
            if (popup == null) return;
            popup.classList.add('active');
            }

            // Add click event listeners to open modal buttons
            openModalButtons.forEach(button => {
            button.addEventListener('click', () => {
                const popup = document.querySelector(button.dataset.modalTarget);
                openModal(popup);
            });
            });

            // Optional: Close the modal when clicking outside of it
            window.addEventListener('click', (e) => {
            openModalButtons.forEach(button => {
                const popup = document.querySelector(button.dataset.modalTarget);
                if (e.target === popup) {
                closeModal(popup);
                }
            });
            });