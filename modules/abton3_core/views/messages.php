<? foreach ($messages as $message): ?>
    toastr.<?= $message['type'] ?>('<?= $message['description'] ?>', '<?= $message['title'] ?>');
<? endforeach; ?>