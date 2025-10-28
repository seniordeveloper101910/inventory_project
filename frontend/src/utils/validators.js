export function required(val){ return val!==undefined && val!==null && val!=='' }
export function isNumber(val){ return typeof val === 'number' && !Number.isNaN(val) }
