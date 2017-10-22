<script>
    vm = new Vue({
        el: '#profile-main',
        data: {
            resume_cv: '{{ $data['resume_cv'] }}',
            showMediaManager: false
        },

        created: function(){
            window.eventHub.$on('media-manager-selected-resume-cv', function (file) {
                this.resume_cv = file.relativePath;
                this.showMediaManager = false;
            }.bind(this));

            window.eventHub.$on('media-manager-notification', function (message, type, time) {
                $.growl({
                    message: message
                },{
                    type: 'inverse',
                    allow_dismiss: false,
                    label: 'Cancel',
                    className: 'btn-xs btn-inverse',
                    placement: {
                        from: 'top',
                        align: 'right'
                    },
                    z_index: 9999,
                    delay: time,
                    animate: {
                        enter: 'animated fadeInRight',
                        exit: 'animated fadeOutRight'
                    },
                    offset: {
                        x: 20,
                        y: 85
                    }
                });
            });

        }
    });
</script>