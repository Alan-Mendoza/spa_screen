
import { usePage } from '@inertiajs/vue3';

export function Spatie() {
    const page = usePage();

    const can = (permission) => {
        return page.props.auth.permissions.includes(permission);
    };

    return { can };
}

