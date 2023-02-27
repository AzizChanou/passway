import { ref } from 'vue';

/**
 * 
 * @param {*} callback 
 * @param {*} time 
 * @returns 
 */
function useThrottle(callback, time) {
    const timer = ref(null)

    function throttled(...args) {
        if (timer.value !== null) {
            clearTimeout(timer.value)
        }
        timer.value = setTimeout(() => {
            callback(...args)
            timer.value = null
        }, time)
    }

    return throttled
};

export default useThrottle;