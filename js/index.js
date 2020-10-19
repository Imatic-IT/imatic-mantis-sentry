import {
    init as initSentry,
    captureException,
    captureMessage,
} from '@sentry/browser';

function sentryError(e) {
    if (typeof e === 'string') {
        captureMessage(e, 'error');
    } else {
        captureException(e);
    }
}

function errorEventToError(e) {
    if (e.error != null) {
        return e.error;
    }

    return new Error(e.message, e.filename, e.lineno);
}

function init() {
    const options = window.IMATIC_SENTRY_OPTIONS;
    if (options == null) {
        return;
    }

    initSentry(options);
    addEventListener('error', (e) => sentryError(errorEventToError(e)));
}

init();
