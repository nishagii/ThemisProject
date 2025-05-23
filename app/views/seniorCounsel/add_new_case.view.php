<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Case</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/addnewcase.css" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>

        input[readonly] {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.85em;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <?php include('component/bigNav.view.php'); ?>
    <?php include('component/smallNav1.view.php'); ?>
    <?php include('component/sidebar.view.php'); ?>
    <main class="home-section">
        <?php if (!empty($errors)): ?>
            <div class="error-container">
                <?php foreach ($errors as $field => $error): ?>
                    <p><?= ucfirst($field) ?>: <?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <section class="new-case-section">
            <div class="new-case-header">
                <h1>Add New Case</h1>
            </div>
            <div class="paragraph-add-case">
                Fill this form details to add a new case to the system. Please ensure the
                <span style="color: #fa9800; font-weight: bold;">Emails</span> and
                <span style="color: #fa9800; font-weight: bold;">Phone numbers</span> are correct.
            </div>

            <form method="POST" action="<?= ROOT ?>/cases/addCase">
           
                <input type="hidden" id="client_id" name="client_id" value="">
                <input type="hidden" id="client_registered" name="client_registered" value="0">

                <div class="form-layout">
         
                    <div class="form-column">

                        <div class="form-container">
                            <h2>Client Information</h2>

                        
                            <div class="form-group">
                                <label for="existing_client">Select Client</label>
                                <select id="existing_client" name="existing_client" class="form-select" onchange="toggleClientFields()">
                                    <option value="new">New Client (Not Registered)</option>
                                    <?php if (isset($clients) && is_array($clients)): ?>
                                        <?php foreach ($clients as $client): ?>
                                            <option value="<?= $client->id ?>">
                                                <?= htmlspecialchars($client->first_name . ' ' . $client->last_name) ?> (<?= htmlspecialchars($client->email) ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div id="client_details_fields">
                                <div class="form-group">
                                    <label for="client_name">Name</label>
                                    <input
                                        id="client_name"
                                        name="client_name"
                                        type="text"
                                        placeholder="Enter client name" />
                                </div>
                                <div class="form-group">
                                    <label for="client_number">WhatsApp Number</label>
                                    <input
                                        id="client_number"
                                        name="client_number"
                                        type="text"
                                        placeholder="Enter WhatsApp number" />
                                </div>
                                <div class="form-group">
                                    <label for="client_email">Email</label>
                                    <input
                                        id="client_email"
                                        type="email"
                                        name="client_email"
                                        placeholder="Enter Email address" />
                                </div>
                                <div class="form-group">
                                    <label for="client_address">Address</label>
                                    <input
                                        id="client_address"
                                        type="text"
                                        name="client_address"
                                        placeholder="Enter Address" />
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-column">
                     
                        <div class="form-container">
                            <h2>Instructing Attorney</h2>
                            <div class="form-group">
                                <label for="attorney_id">Select Attorney</label>
                                <select id="attorney_id" name="attorney_id" class="form-select">
                                    <option value="">Select an attorney</option>
                                    <?php if (isset($attorneys) && is_array($attorneys)): ?>
                                        <?php foreach ($attorneys as $attorney): ?>
                                            <option value="<?= $attorney->id ?>">
                                                <?= htmlspecialchars($attorney->first_name . ' ' . $attorney->last_name) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                    
                        <div class="form-container">
                            <h2>Junior Counsel</h2>
                            <div class="form-group">
                                <label for="junior_id">Select Junior Counsel</label>
                                <select id="junior_id" name="junior_id" class="form-select">
                                    <option value="">Select a junior counsel</option>
                                    <?php if (isset($juniors) && is_array($juniors)): ?>
                                        <?php foreach ($juniors as $junior): ?>
                                            <option value="<?= $junior->id ?>">
                                                <?= htmlspecialchars($junior->first_name . ' ' . $junior->last_name) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                       
                        <div class="form-container">
                            <h2>Case Details</h2>
                            <div class="form-group">
                                <label for="case_number">Case Number</label>
                                <input id="case_number" name="case_number" type="text" placeholder="Enter case number" />
                            </div>
                            <div class="form-group">
                                <label for="court">Court</label>
                                <input id="court" name="court" type="text" placeholder="Enter the court" />
                            </div>
                            <input type="hidden" name="case_status" value="ongoing">
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea
                                    id="notes"
                                    name="notes"
                                    placeholder="Enter any notes here"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="add-case-button">Add Case</button>
            </form>
        </section>
    </main>

    <script>

        function toggleClientFields() {
            const selection = document.getElementById('existing_client').value;
            const clientFields = document.getElementById('client_details_fields');
            const clientIdField = document.getElementById('client_id');
            const clientRegisteredField = document.getElementById('client_registered');

            if (selection === 'new') {
          
                clientFields.style.display = 'block';

     
                document.getElementById('client_name').value = '';
                document.getElementById('client_number').value = '';
                document.getElementById('client_email').value = '';
                document.getElementById('client_address').value = '';

          
                document.getElementById('client_name').readOnly = false;
                document.getElementById('client_number').readOnly = false;
                document.getElementById('client_email').readOnly = false;
                document.getElementById('client_address').readOnly = false;

             
                clientIdField.value = '';
                clientRegisteredField.value = '0';

      
                document.querySelectorAll('#client_details_fields input').forEach(input => {
                    input.style.backgroundColor = '';
                });
            } else {
        
                fetch(`<?= ROOT ?>/users/getUserDetails/${selection}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                          
                            document.getElementById('client_name').value = data.user.first_name + ' ' + data.user.last_name;
                            document.getElementById('client_number').value = data.user.phone || '';
                            document.getElementById('client_email').value = data.user.email || '';
                            document.getElementById('client_address').value = data.user.address || '';


                            document.getElementById('client_name').readOnly = true;
                            document.getElementById('client_number').readOnly = true;
                            document.getElementById('client_email').readOnly = true;

          
                            document.getElementById('client_address').readOnly = false;

                   
                            clientIdField.value = selection;
                            clientRegisteredField.value = '1';

                         
                            document.querySelectorAll('#client_details_fields input[readonly]').forEach(input => {
                                input.style.backgroundColor = '#f8f9fa';
                            });
                        } else {
                            console.error('Error fetching user details:', data.message);
                            alert('Error loading client details. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        alert('Error loading client details. Please try again.');
                    });

            
                clientFields.style.display = 'block';
            }
        }


        document.addEventListener('DOMContentLoaded', function() {
            toggleClientFields();


            document.querySelector('form').addEventListener('submit', function(event) {
                let isValid = true;

                
                document.querySelectorAll('.error-message').forEach(el => el.remove());

             
                const requiredFields = ['case_number', 'court'];

             
                if (document.getElementById('existing_client').value === 'new') {
                    requiredFields.push('client_name', 'client_email', 'client_number');
                }

              
                requiredFields.push('client_address');


                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (field && field.value.trim() === '') {
                        isValid = false;

           
                        const errorMsg = document.createElement('div');
                        errorMsg.className = 'error-message';
                        errorMsg.textContent = 'This field is required';

                       
                        field.parentNode.appendChild(errorMsg);
                    }
                });

                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>

    <script src="<?= ROOT ?>/assets/js/seniorCouncel/case_form_validation.js"></script>
</body>

</html>