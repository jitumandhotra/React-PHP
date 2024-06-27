import React from 'react';
import { useAppContext } from '../../portal/States/states';

const MyComponent = () => {
  const { value, setValue } = useAppContext();

  const handleClick = () => {
    setValue('New Value');
  };

  return (
    <div>
      <p>Current Value: {value}</p>
      <button onClick={handleClick}>Change Value</button>
    </div>
  );
};

export default MyComponent;
