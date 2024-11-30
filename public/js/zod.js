const MIN_FILE_SIZE = 0
const MAX_FILE_SIZE = 2 * 1024 * 1024
const MIME_TYPES = ["image/png", "image/jpeg", "image/jpg", "application/pdf"]

/**
 * zod: A flexible schema validation library.
 */
class Zod {
    #schema = {}

    /**
     * Defines a validation rule for a field.
     *
     * @param {string} name The name of the field.
     * @param {Function} validator The validation function for the field.
     * @param {string|null} invalidMessage Message to return if validation fails.
     * @param {string|null} requiredMessage Message to return if field is required but not present.
     * @returns {this}
     */
    field(
        name,
        validator = null,
        invalidMessage = null,
        requiredMessage = null
    ) {
        this.#schema[name] = [validator, invalidMessage, requiredMessage]
        return this
    }

    /**
     * Validates input data against the defined schema.
     *
     * @param {Object} data The input data to validate.
     * @returns {Object} Result object indicating success or failure.
     */
    parse(data) {
        const result = {
            ok: true,
            error: "",
            data: {},
        }

        for (const key in this.#schema) {
            if (this.#schema.hasOwnProperty(key)) {
                const [validator, invalidMessage, requiredMessage] =
                    this.#schema[key]
                const value = data[key]

                if ([undefined, null, ""].includes(value)) {
                    result.ok = false
                    result.error =
                        requiredMessage ||
                        `${
                            key.charAt(0).toUpperCase() + key.slice(1)
                        } is required.`
                    break
                }

                const response = validator ? validator(value) : { ok: true }

                if (!response.ok) {
                    result.ok = false
                    result.error =
                        invalidMessage ||
                        response.text ||
                        `Invalid input for ${
                            key.charAt(0).toUpperCase() + key.slice(1)
                        }.`
                    break
                }

                result.data[key] = value
            }
        }

        return result
    }

    /**
     * Returns a validator function that checks if a value is a string.
     *
     * @returns {Function}
     */
    string() {
        return (value) => {
            const result = {
                ok: typeof value === "string",
            }
            result.text = result.ok ? "" : "Must be a string."
            return result
        }
    }

    /**
     * Returns a validator function that checks if a value is numeric.
     *
     * @returns {Function}
     */
    number() {
        return (value) => {
            const result = {
                ok: typeof value === "number",
            }
            result.text = result.ok ? "" : "Must be a number."
            return result
        }
    }

    /**
     * Returns a validator function that checks if a value is an array and optionally validates each element.
     *
     * @param {Function|null} func Optional validator function for each element in the array.
     * @returns {Function}
     */
    array(func = null) {
        return (value) => {
            const result = {
                ok: Array.isArray(value),
            }

            if (!result.ok) {
                result.text = "Invalid input. Expected an array."
                return result
            }

            if (func) {
                for (const item of value) {
                    const res = func(item)
                    if (!res.ok) {
                        result.ok = false
                        result.text = "Invalid array element."
                        return result
                    }
                }
            }

            return result
        }
    }

    /**
     * Returns a validator function that checks if a value is a valid email address.
     *
     * @returns {Function}
     */
    email() {
        return (value) => {
            const result = {
                ok: /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value),
            }
            result.text = result.ok ? "" : "Invalid email address."
            return result
        }
    }

    /**
     * Returns a validator function that checks if a value is a valid URL.
     *
     * @returns {Function}
     */
    url() {
        return (value) => {
            const result = {
                ok: /^(ftp|http|https):\/\/[^ "]+$/.test(value),
            }
            result.text = result.ok ? "" : "Invalid URL."
            return result
        }
    }

    /**
     * Returns a validator function that checks if a value matches a given regular expression.
     *
     * @param {string} regex The regular expression to match against.
     * @returns {Function}
     */
    regex(regex) {
        return (value) => {
            const result = {
                ok: regex.test(value),
            }
            result.text = result.ok ? "" : "Invalid format."
            return result
        }
    }

    /**
     * Returns a validator function that checks if a value is a valid base64 encoded string.
     *
     * @returns {Function}
     */
    base64() {
        return (value) => {
            const result = {
                ok: /^[A-Za-z0-9+/=]+$/.test(value),
            }
            result.text = result.ok ? "" : "Invalid base64 string."
            return result
        }
    }

    /**
     * Returns a validator function that checks if a value is a valid JSON string.
     *
     * @returns {Function}
     */
    json() {
        return (value) => {
            const result = {
                ok: (() => {
                    try {
                        JSON.parse(value)
                        return true
                    } catch {
                        return false
                    }
                })(),
            }
            result.text = result.ok ? "" : "Invalid JSON string."
            return result
        }
    }

    /**
     * Returns a validator function that checks if a value is a valid IP address.
     *
     * @returns {Function}
     */
    ip() {
        return (value) => {
            const result = {
                ok: /^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/.test(value),
            }
            result.text = result.ok ? "" : "Invalid IP address."
            return result
        }
    }

    /**
     * Returns a validator function that checks if a value is a valid UUID.
     *
     * @returns {Function}
     */
    uuid() {
        return (value) => {
            const result = {
                ok: /^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i.test(
                    value
                ),
            }
            result.text = result.ok ? "" : "Invalid UUID."
            return result
        }
    }

    /**
     * Returns a validator function that checks if a value is a valid date string.
     *
     * @returns {Function}
     */
    date() {
        return (value) => {
            const result = {
                ok: !isNaN(Date.parse(value)),
            }
            result.text = result.ok ? "" : "Invalid date."
            return result
        }
    }

    /**
     * Returns a validator function that checks if a value is a valid datetime string.
     *
     * @returns {Function}
     */
    datetime() {
        return this.date()
    }

    /**
     * Returns a validator function that checks if a value is a valid time string.
     *
     * @returns {Function}
     */
    time() {
        return this.date()
    }

    /**
     * Returns a validator function that checks if a value is a boolean.
     *
     * @returns {Function}
     */
    boolean() {
        return (value) => {
            const result = {
                ok: typeof value === "boolean",
            }
            result.text = result.ok ? "" : "Must be a boolean."
            return result
        }
    }

    /**
     * Returns a validator function that checks if a string includes a given substring.
     *
     * @param {string} includes The substring that should be included.
     * @returns {Function}
     */
    includes(includes) {
        return (value) => {
            const result = {
                ok: value.includes(includes),
            }
            result.text = result.ok ? "" : `Must include "${includes}".`
            return result
        }
    }

    /**
     * Returns a validator function that checks if a string starts with a given substring.
     *
     * @param {string} startsWith The substring that should be at the start.
     * @returns {Function}
     */
    startsWith(startsWith) {
        return (value) => {
            const result = {
                ok: value.startsWith(startsWith),
            }
            result.text = result.ok ? "" : `Must start with "${startsWith}".`
            return result
        }
    }

    /**
     * Returns a validator function that checks if a string ends with a given substring.
     *
     * @param {string} endsWith The substring that should be at the end.
     * @returns {Function}
     */
    endsWith(endsWith) {
        return (value) => {
            const result = {
                ok: value.endsWith(endsWith),
            }
            result.text = result.ok ? "" : `Must end with '${endsWith}'`
            return result
        }
    }
    /**
     * Returns a validator function that checks if a string has a length within a given range.
     *
     * @param {number} min The minimum length.
     * @param {number} max The maximum length.
     * @returns {Function}
     */
    length(min, max) {
        return (value) => {
            const result = {
                ok: value.length >= min && value.length <= max,
            }
            result.text = result.ok
                ? ""
                : `Length must be between ${min} and ${max}.`
            return result
        }
    }

    /**
     * Returns a validator function that checks if a number is within a given range.
     *
     * @param {number} min The minimum value.
     * @param {number} max The maximum value.
     * @returns {Function}
     */
    between(min, max) {
        return (value) => {
            const result = {
                ok: value >= min && value <= max,
            }
            result.text = result.ok ? "" : `Must be between ${min} and ${max}.`
            return result
        }
    }

    /**
     * Returns a validator function that checks if a number is greater than a given value.
     *
     * @param {number} min The minimum value.
     * @returns {Function}
     */
    gt(min) {
        return (value) => {
            const result = {
                ok: value > min,
            }
            result.text = result.ok ? "" : `Must be greater than ${min}.`
            return result
        }
    }

    /**
     * Returns a validator function that checks if a number is greater than or equal to a given value.
     *
     * @param {number} min The minimum value.
     * @returns {Function}
     */
    gte(min) {
        return (value) => {
            const result = {
                ok: value >= min,
            }
            result.text = result.ok
                ? ""
                : `Must be greater than or equal to ${min}.`
            return result
        }
    }

    /**
     * Returns a validator function that checks if a number is less than a given value.
     *
     * @param {number} max The maximum value.
     * @returns {Function}
     */
    lt(max) {
        return (value) => {
            const result = {
                ok: value < max,
            }
            result.text = result.ok ? "" : `Must be less than ${max}.`
            return result
        }
    }

    /**
     * Returns a validator function that checks if a number is less than or equal to a given value.
     *
     * @param {number} max The maximum value.
     * @returns {Function}
     */
    lte(max) {
        return (value) => {
            const result = {
                ok: value <= max,
            }
            result.text = result.ok
                ? ""
                : `Must be less than or equal to ${max}.`
            return result
        }
    }

    /**
     * Returns a validator function that checks if a value is in a given array of options.
     *
     * @param {Array} options The array of options.
     * @returns {Function}
     */
    in(options) {
        return (value) => {
            const result = {
                ok: options.includes(value),
            }
            result.text = result.ok
                ? ""
                : `Must be one of ${options.join(", ")}.`
            return result
        }
    }

    /**
     * Returns a validator function that checks if a file has a valid size and MIME type.
     *
     * @returns {Function}
     */
    file() {
        return (value) => {
            const result = {
                ok:
                    value.size >= MIN_FILE_SIZE &&
                    value.size <= MAX_FILE_SIZE &&
                    MIME_TYPES.includes(value.type),
            }

            if (!result.ok) {
                result.text = "Invalid file."
            }

            return result
        }
    }

    /**
     * Returns a validator function that checks if a value is a valid object.
     *
     * @returns {Function}
     */
    object() {
        return (value) => {
            const result = {
                ok:
                    typeof value === "object" &&
                    value !== null &&
                    !Array.isArray(value),
            }
            result.text = result.ok ? "" : "Must be an object."
            return result
        }
    }
}
