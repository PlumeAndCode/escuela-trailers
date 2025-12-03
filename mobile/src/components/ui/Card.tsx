import React from "react";
import { View, ViewProps } from "react-native";

interface CardProps extends ViewProps {
    children: React.ReactNode;
    variant?: "default" | "elevated" | "outlined";
}

export const Card: React.FC<CardProps> = ({
    children,
    variant = "default",
    className,
    ...props
}) => {
    const variantClasses = {
        default: "bg-white rounded-2xl p-4",
        elevated: "bg-white rounded-2xl p-4 shadow-lg shadow-black/10",
        outlined: "bg-white rounded-2xl p-4 border border-slate-200",
    };

    return (
        <View className={`${variantClasses[variant]} ${className || ""}`} {...props}>
            {children}
        </View>
    );
};
