import { ref } from 'vue';
export function useClipboard(text){

    let copied = ref(false);
    let supported = navigator && 'clipboard' in navigator;
    function copy(){
        if( supported ){
            navigator.clipboard.writeText(text);
            copied.value = true;
            return;
        }

        alert('Copy not supported');
    }

    return { copy, copied, supported };

}
