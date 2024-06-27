import React, { createContext, useContext, useState } from 'react';
const AppContext = createContext();
export const AppProvider = ({ children }) => {
  const [value, setValue] = useState('Initial Value');
  return (
    <AppContext.Provider value={{ value, setValue }}>
      {children}
    </AppContext.Provider>
  );
};
export const useAppContext = () => useContext(AppContext);

