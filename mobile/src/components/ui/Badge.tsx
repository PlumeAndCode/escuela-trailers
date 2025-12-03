import React from "react";
import { View, Text } from "react-native";

interface BadgeProps {
    label: string;
    variant?: "success" | "warning" | "error" | "info" | "default";
    size?: "sm" | "md";
}

export const Badge: React.FC<BadgeProps> = ({ label, variant = "default", size = "md" }) => {
    const variantClasses = {
        success: "bg-green-100",
        warning: "bg-amber-100",
        error: "bg-red-100",
        info: "bg-blue-100",
        default: "bg-slate-100",
    };

    const textVariantClasses = {
        success: "text-green-700",
        warning: "text-amber-700",
        error: "text-red-700",
        info: "text-blue-700",
        default: "text-slate-700",
    };

    const sizeClasses = {
        sm: "px-2 py-0.5",
        md: "px-3 py-1",
    };

    const textSizeClasses = {
        sm: "text-xs",
        md: "text-sm",
    };

    return (
        <View className={`rounded-full ${variantClasses[variant]} ${sizeClasses[size]}`}>
            <Text className={`font-medium ${textVariantClasses[variant]} ${textSizeClasses[size]}`}>
                {label}
            </Text>
        </View>
    );
};
