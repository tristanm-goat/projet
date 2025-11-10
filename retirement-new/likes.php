<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Likes</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css" />
  </head>
<body>
<?php 
  include 'view/header.php'; 
  include 'php/account_like_list.php';

  // Redirect to login if user is not logged in
  if ($loggedin !== true) {
      header("Location: login.php");
      exit();
  }

  $liked_facilities = get_liked_facilities($_SESSION['username']);
?>

<!--  Likes Page -->
        <h2>Your Liked Retirement Homes</h2>
 <div class="account-portal-body">
    <div class="account-portal-container">
      <div class="liked-facilities-section">
        <ul class="liked-facility-list">
            <?php if (empty($liked_facilities)): ?>
                <li class="liked-facility-item">
                    <p>You haven't saved any facilities yet. Go to the <a href="facility.php">Facility</a> page to find and save your favorites!</p>
                </li>
            <?php else: ?>
                <?php foreach ($liked_facilities as $facility): ?>
                    <li class="liked-facility-item">
                        <h3><?php echo htmlspecialchars($facility['name']); ?></h3>
                        <div class="facility-details-grid">
                            <p><strong>Address:</strong> <?php echo htmlspecialchars($facility['streetaddress'] . ', ' . $facility['citytown'] . ' ' . $facility['postal']); ?></p>
                            <p><strong>License #:</strong> <?php echo htmlspecialchars($facility['lic_number']); ?></p>
                            <p><strong>License Status:</strong> <?php echo htmlspecialchars($facility['lic_status']); ?></p>
                            <p><strong>Resident Capacity:</strong> <?php echo htmlspecialchars($facility['resident_capacity']); ?></p>
                            <p><strong>Number of Suites:</strong> <?php echo htmlspecialchars($facility['number_of_suites']); ?></p>
                            <?php if (!empty($facility['previously_known_as'])): ?>
                                <p><strong>Previously Known As:</strong> <?php echo htmlspecialchars($facility['previously_known_as']); ?></p>
                            <?php endif; ?>
                        </div>

                        <h4>Care Services Offered:</h4>
                        <ul class="services-list">
                            <?php
                                $services = [
                                    'assistance_with_bathing' => 'Assistance with Bathing',
                                    'assistance_with_personal_hygiene' => 'Personal Hygiene Assistance',
                                    'assistance_with_ambulation' => 'Ambulation Assistance',
                                    'assistance_with_feeding' => 'Feeding Assistance',
                                    'provision_of_skin_and_wound_care' => 'Skin and Wound Care',
                                    'continence_care' => 'Continence Care',
                                    'administration_of_drugs_or_another_substance' => 'Medication Administration',
                                    'provision_of_a_meal' => 'Meal Provision',
                                    'dementia_care_program' => 'Dementia Care Program',
                                    'assistance_with_dressing' => 'Assistance with Dressing',
                                    'pharmacists_provides_while_engaging_in_the_practice_of_pharmacy' => 'Pharmacist Services',
                                    'phy_and_surg_provides_while_engaging_in_the_practice_of_medicine' => 'Physician/Surgeon Services',
                                    'nurses_provides_while_engaging_in_the_practice_of_nursing' => 'Nursing Services',
                                ];

                                foreach ($services as $key => $description) {
                                    if (isset($facility[$key]) && $facility[$key] === 'TRUE') {
                                        echo '<li>' . htmlspecialchars($description) . '</li>';
                                    }
                                }
                            ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
      </div>
      <!-- The logout button is typically in the main account portal or header, not specifically on the likes page. -->
      </div>
</div>
  <!-- Footer Section -->
<?php include 'view/footer.php'; ?>

</body>
</html>