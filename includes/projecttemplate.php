<div class="page page-project" style="background-image:linear-gradient(180deg, rgba(255, 255, 255, .85), #eee), url('<?php if(isset($project['img'])) print $project['img'] ?>')">
  <h1 class="project-name"><?php if(isset($project['name'])) print $project['name'] ?></h1>
  <em class="project-tech"><?php if(isset($project['tech'])) print $project['tech'] ?></em>
  <h2 class="project-job-title"><?php if(isset($project['jobtitle'])) print $project['jobtitle'] ?></h2>
    <?php if(isset($project['content'])) {
          print $project['content'];
        }
    ?>
  <div class="project-link">
    <a href="<?php if(isset($project['link'])) print $project['link'] ?>" rel="nofollow" target="_blank">Visit Site</a>
  </div>
</div>
