<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <?php echo $this->tag->getTitle(); ?>
    <?php echo $this->tag->stylesheetLink('css/bootstrap.min.css'); ?>
    <?php echo $this->tag->stylesheetLink('//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'); ?>
    <?php echo $this->tag->stylesheetLink('css/datepicker.css'); ?>
    <?php echo $this->tag->stylesheetLink('css/style.css'); ?>
    <link rel="shortcut icon" href="<?php echo $this->url->get('favicon.ico'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Studio Paolo Frangiolli">
</head>
<body>
<?php echo $this->tag->javascriptInclude('http://code.jquery.com/jquery-2.1.0.min.js', false); ?>
<?php echo $this->tag->javascriptInclude('js/bootstrap.min.js'); ?>
<?php echo $this->tag->javascriptInclude('js/bootstrap-datepicker.js'); ?>

<?php echo $this->getContent(); ?>
</body>
</html>
