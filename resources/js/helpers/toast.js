import { usePage } from '@inertiajs/vue3';
import { useToast } from 'maz-ui';
import { watch } from 'vue';

export default function toast() {

    const { toast } = useToast();

    function showInfo(message) {
        toast.info(message)
    }

    function showError(message) {
        toast.error(message)
    }

    function showWarning(message) {
        toast.warning(message)
    }

    function showSuccess(message) {
        toast.success(message)
    }

    console.log(usePage.props);

    watch(() => usePage?.props?.flash,
        (newFlash) => {
            console.table(newFlash, "Test OKKKKKKKK");
            switch (newFlash) {
                case newFlash.success:
                    showSuccess(newFlash.success);
                    break;
                case newFlash.info:
                    showInfo(newFlash.info);
                    break;
                case newFlash.error:
                    showError(newFlash.error);
                    break;
                case newFlash.warning:
                    showWarning(newFlash.warning);
                    break;
                default:
                    break;
            }
        },
        { deep: true }
    );
};