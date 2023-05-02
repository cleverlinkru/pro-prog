<script>
import axios from 'axios';

export default {
    created() {
        let data = {};
        let items = window.location.hash.substring(1).split('&');
        items.forEach((item) => {
            item = item.split('=');
            data[item[0]] = item[1];
        });
        axios.post(route('analytics.saveYandexToken'), {
            token: data.access_token,
        }).then((response) => {
            if (response.data.success) {
                window.close();
            } else {
                alert('Error');
            }
        });
    },
}
</script>
