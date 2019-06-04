<?php
    require("resources/functions/course/CourseDetails.php");
?>
<!doctype html>
<html lang="en">
<head>
    <?php include("resources/includes/head.inc.php"); ?>
    <script src="resources/js/course.details.js"></script>
</head>
<body>
<?php include("resources/includes/header.inc.php"); ?>

<main class="mb-4">
    <div class="container">
        <?php
            $courseDetails = new CourseDetails($_GET["id"]);

            if ($courseDetails->getTitle() == "" && $courseDetails->getCreditHours() == "") {
                echo '<div class="row text-center">
                    <div class="col-12 my-4">
                        <i class="fas fa-trophy fa-10x text-orange"></i>
                    </div>
                    <div class="col-12">
                        <h3>Congratulations, you broke it!</h3>
                    </div>
                    <div class="col-12">
                        <p>We weren\'t able to find the class you\'re looking for.</p>
                        <a href="index.php" class="btn btn-warning">Return to Homepage</a>
                    </div>
                </div>';
                return;
            }
        ?>

        <div class="row">
            <div class="col-12 col-lg-10 pt-4">
                <h3 class="font-weight-bold"><?php echo $courseDetails->getTitle(); ?> - Fall 2019</h3>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-12 col-md-9 col-lg-6 col-xl-5">
                <div class="row">
                    <div class="col-12 col-sm-3">
                        <h5><?php echo $courseDetails->getId() ?></h5>
                    </div>
                    <div class="col-12 col-sm-3">
                        <h5><?php echo $courseDetails->getCreditHours(); ?> Credits</h5>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h5><?php echo $courseDetails->getSeatsOpen(); ?> Seats Available</h5>
                    </div>
                </div>
            </div>
        </div>

        <?php if (sizeof($courseDetails->getSections()) == 0) { ?>

        <div class="row">
            <div class="col-12">
                <h5 class="my-4">No sections found for selected term.</h5>
            </div>
        </div>

        <?php } ?>

        <?php
            $prev = null;
            foreach ($courseDetails->getSections() as $section) {
                if (!isset($prev)) {
        ?>
                    <div class="row">
                        <div class="col-12">
                            <h4 class="font-weight-bold mb-3"><?php echo $section->getCampus(); ?> Campus</h4>
                        </div>
                    </div>
                    <div class="row">
            <?php } else if (isset($prev) && $prev->getCampus() != $section->getCampus()) { ?>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h4 class="font-weight-bold mb-3"><?php echo $section->getCampus(); ?> Campus</h4>
                        </div>
                    </div>
                    <div class="row">
            <?php } ?>
            <div class="col-12 col-md-6 col-lg-4 mb-3 section">
                <div class="card">
                    <div class="card-header bg-blue"><h5 class="my-1 text-white">Section <?php echo explode('-', $section->getCourse())[2] . ' (' . $section->getCrn() . ')'; ?></h5></div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><span class="font-weight-bold">Meets on</span> <div class="w-100 d-block d-sm-none"></div><span class="float-sm-right"><?php echo $section->getMeetDays() . ' ' . $section->getStartTime() . ' - ' . $section->getEndTime(); ?></span></li>
                        <li class="list-group-item"><span class="font-weight-bold">Meets in</span> <div class="w-100 d-block d-sm-none"></div><span class="float-sm-right"><?php echo $section->getLocation(); ?></span></li>
                        <li class="list-group-item"><span class="font-weight-bold">Taught by</span> <div class="w-100 d-block d-sm-none"></div><span class="float-sm-right"><?php echo str_replace("(P)", "", $section->getInstructor()); ?></span></li>
                        <li class="list-group-item"><span class="font-weight-bold">Students enrolled</span> <div class="w-100 d-block d-sm-none"></div><span class="float-sm-right"><?php echo $section->getEnrolled() . "/" . (integer)($section->getRemainOpen() + $section->getEnrolled()); ?></span></li>
                    </ul>
                    <div class="card-body">

            <?php
                if (isset($_SESSION['user']['email'])) {
                    if (in_array($section->getCrn(), $courseDetails->getUserSubscribedCourses($_SESSION['user']['email']))) {
                        echo '<button type="button" class="btn btn-warning" disabled>Subscribed</button>';
                    }
                    else {
                        echo '<button type="button" class="btn btn-warning" id="btn' . $section->getCrn() . '" onclick="subscribeByCrn(\'' . $section->getCrn() . '\', \'' . $_SESSION['user']['email'] . '\')">Subscribe</button>';
                    }
                }
                else {
                    echo '<a href="login.php" class="btn btn-warning">Login to Subscribe</a>';
                }
                $prev = $section;

                echo '</div></div></div>';
            }

            if (sizeof($courseDetails->getSections()) > 0) {
                echo '</div>';
            }

            $courseDetails->outputReviewSection();
            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br />
</main>

<?php include('resources/includes/footer.inc.php'); ?>

</body>
</html>


