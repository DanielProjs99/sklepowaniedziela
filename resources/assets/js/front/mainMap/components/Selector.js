import React from "react";

const Selector = ({ sundays, selected, onSundayChange }) => {
    let sundayIdSelect = null;

    return (
        <div className="text-right">
            <label htmlFor="map-sunday-selector" style={{fontSize: "18px", marginRight: "10px"}}>
                Wybierz dzień niehandlowy:
            </label>
            <select ref={node => sundayIdSelect = node} value={selected ? selected : 0} onChange={e => {
                onSundayChange(sundayIdSelect.value);
            }}>
                {sundays.map(sunday => {
                    return (
                    <option key={sunday.id} value={sunday.id}>{sunday.date}</option>
                );
                })}
            </select>
        </div>
    );
};

export default Selector;
