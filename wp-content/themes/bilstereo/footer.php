</div>

</section>

<footer id="footer" class="site-footer" role="contentinfo">
    <div class="footer-inner container">
        <div class="row">
            <div id="footer-sidebar" class="secondary">
                <div id="footer-sidebar1" class="footer-inner">
                    <?php
                    if(is_active_sidebar('footer-sidebar-1')){
                        dynamic_sidebar('footer-sidebar-1');
                    }
                    ?>
                </div>
                <div id="footer-sidebar2" class="footer-inner">
                    <?php
                    if(is_active_sidebar('footer-sidebar-2')){
                        dynamic_sidebar('footer-sidebar-2');
                    }
                    ?>
                </div>
                <div id="footer-sidebar3" class="footer-inner">
                    <?php
                    if(is_active_sidebar('footer-sidebar-3')){
                        dynamic_sidebar('footer-sidebar-3');
                    }
                    ?>
                </div>
            </div>


        </div>
    </div>
    <div class="site-info container">
        <p>&copy; <?php echo date('Y'); ?> - Nicklas Andersen </p>
    </div>
</footer>

<!-- Wrapper Ends -->
</div>
<?php wp_footer(); ?>
</body>
</html>
