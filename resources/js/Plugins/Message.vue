<script>
import {Inertia} from '@inertiajs/inertia';
import {message} from 'ant-design-vue';

Inertia.on('success', (event) => {
    console.log(Inertia.page.props);
    if (Inertia.page.props.flash.message) {
        if (Inertia.page.props.flash.message.status) {
            message.success(Inertia.page.props.flash.message.text);
        } else {
            message.error(Inertia.page.props.flash.message.text);
        }
    }
});
</script>
