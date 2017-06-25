<?php
/**
 * @file
 * Display the progress bar for multipage forms
 *
 * Available variables:
 * - $node: The webform node.
 * - $progressbar_page_number: TRUE if the actual page number should be
 *   displayed.
 * - $progressbar_percent: TRUE if the percentage complete should be displayed.
 * - $progressbar_bar: TRUE if the bar should be displayed.
 * - $progressbar_pagebreak_labels: TRUE if the page break labels shoud be
 *   displayed.

 * - $page_num: The current page number.
 * - $page_count: The total number of pages in this form.
 * - $page_labels: The labels for the pages. This typically includes a label for
 *   the starting page (index 0), each page in the form based on page break
 *   labels, and then the confirmation page (index number of pages + 1).
 * - $percent: The percentage complete.
 */
?>
<div class="webform-progressbar">
  <?php if ($progressbar_bar): ?>
    <div class="page-wrapper">
      <div class="pg-section">
      <ul>
      <?php for ($n = 1; $n <= $page_count; $n++): ?>
        <li id="<?php print $n; ?>" class="webform-progressbar-page<?php print $n; ?> <?php if ($n < $page_num) { print ' completed'; }; ?><?php if ($n == $page_num) { print ' current'; }; ?>">
            <?php print check_plain($page_labels[$n - 1]); ?>
            <?php if ($n < $page_num) { print '<span>&#10004;</span>'; }; ?>
        </li>
      <?php endfor; ?>
      </ul>
      </div>
    </div>
  <?php endif; ?>


  <?php if ($progressbar_page_number): ?>
    <div class="webform-progressbar-number">
      <?php print t('Page @start of @end', array('@start' => $page_num, '@end' => $page_count)); ?>
      <?php if ($progressbar_percent): ?>
        <span class="webform-progressbar-number">
          (<?php print number_format($percent, 0); ?>%)
        </span>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <?php if (!$progressbar_page_number && $progressbar_percent): ?>
    <div class="webform-progressbar-number">
      <?php print number_format($percent, 0); ?>%
    </div>
  <?php endif; ?>
</div>
