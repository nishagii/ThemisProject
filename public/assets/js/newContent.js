export function createNewContent(innerLeftPanel) {
    const newContent = document.createElement("div");
    newContent.innerHTML = `
        <i class='bx bx-x-circle' id="closeButton" style="cursor: pointer;"></i>

        <div class="message">
            <h4>Contacts</h4>
        </div>

        <div class="contact" style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
            <i class='bx bx-user' style="font-size: 35px; color: #a8a8a9;"></i>
            <h5>Username</h5>
        </div>

        <div class="contact" style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
            <i class='bx bx-user' style="font-size: 35px; color: #a8a8a9;"></i>
            <h5>Username</h5>
        </div>

        <div class="contact" style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
            <i class='bx bx-user' style="font-size: 35px; color: #a8a8a9;"></i>
            <h5>Username</h5>
        </div>

        <div class="contact" style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
            <i class='bx bx-user' style="font-size: 35px; color: #a8a8a9;"></i>
            <h5>Username</h5>
        </div>
    `;

    newContent.id = "newComponent";

    // Style the newContent
    newContent.style.position = "absolute";
    newContent.style.top = "0";
    newContent.style.left = "0";
    newContent.style.width = `${innerLeftPanel.offsetWidth}px`;
    newContent.style.height = "100%";
    newContent.style.zIndex = "10";
    newContent.style.borderRight = "0.5px solid rgb(214, 214, 214)";

    // Add close functionality
    setTimeout(() => {
        const closeButton = newContent.querySelector("#closeButton");
        if (closeButton) {
            closeButton.addEventListener("click", function () {
                innerLeftPanel.removeChild(newContent);
            });
        }
    }, 100);

    return newContent;
}
