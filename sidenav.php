<div class="sidebar">
    <nav class="sidenav">
        <div>
            <a href="class_template-<?php if ($_SESSION["role"] === 2) {
                                        echo "s";
                                    } elseif ($_SESSION["role"] === 1) {
                                        echo "t";
                                    } ?>.php<?php echo '?id=' . $url_id; ?>">Classroom</a>
            <a href="upcoming_tasks.php<?php echo '?id=' . $url_id; ?>">Upcoming Tasks</a>
            <a href="submissions.php<?php echo '?id=' . $url_id; ?>">Submissions</a>
            <a href="uploadreferences.php<?php echo '?id=' . $url_id; ?>">References</a>
            <?php if ($_SESSION["role"] === 1) { ?>
                <a href="addassignment.php<?php echo '?id=' . $url_id; ?>">Add Assignment</a>
                <a href="addtest.php<?php echo '?id=' . $url_id; ?>">Add Test</a>
            
            <?php } ?>
        </div>
    </nav>
</div>