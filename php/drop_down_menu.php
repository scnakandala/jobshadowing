<div>
    <div style="width: 95%;float: left">
        <hr/>
    </div>
    <div style="float: right">
        <ul class="menu">
            <li>
                <a href="#"><img src="./webroot/images/more_button.jpg"></a>
                <ul>
                    <li>
                        <?php
                        print '<a class="filter" parent_content_id=' . $count . '_mentorList' .
                                ' href="./mentor_filter.php?org_id=' . $org_id . '">See All</a></li>';
                        ?>
                    </li>
                    <?php
                    $roles = getRoles();
                    foreach ($roles as $role) {
                        if ($role[1] == 'Student') {
                            continue;
                        }
                        print '<li><a class="filter" parent_content_id=' . $count . '_mentorList' .
                                ' href="./mentor_filter.php?org_id=' . $org_id
                                . '&filter_role_id=' . $role[0] . '">' . $role[1]
                                . 's</a></li>';
                    }
                    ?>
                </ul>
            </li>
        </ul>
    </div>
</div>