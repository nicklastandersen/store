</div>

</section>

<footer id="footer" class="site-footer" role="contentinfo">
    <div class="container">
        <aside id="sidebar-footer" class="sidebar sidebar-footer" role="complementary">
            <div class="row">
                <aside id="footer-sidebar1" class="footer-inner">
                    <?php
                    if(is_active_sidebar('footer-sidebar-1')){
                        dynamic_sidebar('footer-sidebar-1');
                    }
                    ?>
                </aside>
                <aside id="footer-sidebar2" class="footer-inner">
                    <?php
                    if(is_active_sidebar('footer-sidebar-2')){
                        dynamic_sidebar('footer-sidebar-2');
                    }
                    ?>
                </aside>
                <aside id="footer-sidebar3" class="footer-inner">
                    <?php
                    if(is_active_sidebar('footer-sidebar-3')){
                        dynamic_sidebar('footer-sidebar-3');
                    }
                    ?>
                </aside>
            </div>
        </aside>
        <div class="row">
            <div class="site-info">
                <p>&copy; <?php echo date('Y'); ?> - Nicklas Andersen </p>
            </div>
        </div>
    </div>


</footer>

<!-- Wrapper Ends -->
</div>
<?php wp_footer(); ?>
</body>
</html>
